<?php

namespace XCJS\Sparkup;

interface IDomNodeExtensions {
    public function getDataSource();
    public function setDataSource($source);
    public function databind();
} 