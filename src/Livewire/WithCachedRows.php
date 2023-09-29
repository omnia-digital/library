<?php

namespace OmniaDigital\OmniaLibrary\Livewire;

trait WithCachedRows
{
    protected bool $useCache = false;
    protected int $cacheTtl = 60 * 60;

    public function useCachedRows()
    {
        $this->useCache = true;
    }

    public function getCacheKey()
    {
        return $this->id;
    }

    public function getCacheTtl()
    {
        return $this->cacheTtl;
    }

    public function cache($callback)
    {
        $cacheKey = $this->getCacheKey();

        if ($this->useCache && cache()->has($cacheKey)) {
            return cache()->get($cacheKey);
        }

        $result = $callback();

        cache()->put($cacheKey, $result, $this->getCacheTtl());

        return $result;
    }
}
