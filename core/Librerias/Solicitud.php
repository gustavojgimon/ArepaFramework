<?php


namespace Core\Librerias;


class Solicitud
{
    private  $variable;
    public function post($index = null, $filter = null, $flags = null)
    {
        return $this->obtenerVariables('post', $index, $filter, $flags);
    }

    public function obtenerVariables($metodo, $index = null, $filter = null, $flags = null)
    {
        $metodo = strtolower($metodo);

        if (!isset($this->variable[$metodo])) {
            $this->globales($metodo);
        }

        // Los filtros null hacen que se devuelvan los valores nulos.
        if (is_null($filter)) {
            $filter = FILTER_DEFAULT;
        }

        // Devuelve todos los valores cuando $index es null
        if (is_null($index)) {
            $values = [];
            foreach ($this->variable[$metodo] as $key => $value) {
                $values[$key] = is_array($value)
                    ? $this->obtenerVariables($metodo, $key, $filter, $flags)
                    : filter_var($value, $filter, $flags);
            }

            return $values;
        }


        // Me permite recuperar varias keys a la vez
        if (is_array($index)) {
            $output = [];

            foreach ($index as $key) {
                $output[$key] = $this->obtenerVariables($metodo, $key, $filter, $flags);
            }

            return $output;
        }

        // El índice contiene notación de matriz?
        if (($count = preg_match_all('/(?:^[^\[]+)|\[[^]]*\]/', $index, $matches)) > 1) {
            $value = $this->variable[$metodo];
            for ($i = 0; $i < $count; $i++) {
                $key = trim($matches[0][$i], '[]');

                if ($key === '') // La notación vacía devolverá el valor como array
                {
                    break;
                }

                if (isset($value[$key])) {
                    $value = $value[$key];
                } else {
                    return null;
                }
            }
        }

        if (!isset($value)) {
            $value = $this->variable[$metodo][$index] ?? null;
        }


        // No se pueden filtrar estos tipos de datos automáticamente ...
        if (is_array($value) || is_object($value) || is_null($value)) {
            return $value;
        }

        return filter_var($value, $filter, $flags);
    }

    /**
     * Guarda una copia del estado actual de uno de varios globales de PHP
     * para que podamos recuperarlos más tarde.
     *
     * @param string $metodo
     */
    protected function globales(string $metodo)
    {
        if (!isset($this->variable[$metodo])) {
            $this->variable[$metodo] = [];
        }


        switch ($metodo) {
            case 'get':
                $this->variable['get'] = $_GET;
                break;
            case 'post':
                $this->variable['post'] = $_POST;
                break;
            case 'request':
                $this->variable['request'] = $_REQUEST;
                break;
            case 'cookie':
                $this->variable['cookie'] = $_COOKIE;
                break;
            case 'server':
                $this->variable['server'] = $_SERVER;
                break;
        }
    }

    //--------------------------------------------------------------------

    public function get($index = null, $filter = null, $flags = null)
    {
        return $this->obtenerVariables('get', $index, $filter, $flags);
    }
}