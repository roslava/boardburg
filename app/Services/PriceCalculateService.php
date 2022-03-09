<?php

namespace App\Services;

class PriceCalculateService
{
    /**
     * @param array $data
     * @param $method
     * @return int
     * @throws \Exception
     */
    public function start(array $data, $method = 'minus'): int
    {
        if (method_exists($this, $method)) {
            return $this->$method((int) $data['a'], (int) $data['b']);
        }
        throw new \Exception('Метод не найден', 404);
    }

    /**
     * @param int $a
     * @param int $b
     * @return int
     */
    protected function minus(int $a, int $b): int
    {
        return intval($a - $b);
    }

    /**
     * @param int $a
     * @param int $b
     * @return int
     */
    protected function plus(int $a, int $b): int
    {
        return intval($a + $b);
    }

}
