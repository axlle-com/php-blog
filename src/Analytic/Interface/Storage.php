<?php

namespace Main\Analytic\Interface;

use Main\Analytic\Model\AnalyticData;

interface Storage
{
    public function create(AnalyticData $data);
}
