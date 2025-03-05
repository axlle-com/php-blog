<?php

namespace Main\Analytic\Interface;

use Main\Analytic\Model\AnalyticData;

interface Provider
{
    public function create(AnalyticData $data);
}
