<?php

namespace OmniaDigital\OmniaLibrary\Livewire;

trait WithCachedRows
{
    protected bool $useCache = false;

    public function useCachedRows()
    {
        $this->useCache = true;
    }

    public function getCacheKey()
    {
        return $this->id;
    }

    public function cache($callback)
    {
        $cacheKey = $this->getCacheKey();

        if ($this->useCache && cache()->has($cacheKey)) {
            return cache()->get($cacheKey);
        }

        $result = $callback();

        cache()->put($cacheKey, $result);

        return $result;
    }
}
