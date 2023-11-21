<?php

namespace OmniaDigital\OmniaLibrary\Livewire;

trait WithCachedRows
{
    protected bool $useCache = false;
    protected int $cacheTtl = 60 * 60;

    protected string $cacheKey = '';

    protected array $tags = [];

    public function useCachedRows()
    {
        $this->useCache = true;
    }

    public function useTags($tags)
    {
        $this->tags = $tags;
    }

    public function getCacheKey()
    {
        return $this->cacheKey ?? $this->id;
    }

    public function getCacheTtl()
    {
        return $this->cacheTtl;
    }

    public function cache($callback)
    {
        $cacheKey = $this->getCacheKey();
        $cache = cache();

        if ($this->useCache && $cache->has($cacheKey)) {
            if (! empty($this->tags)) {
                $cache = $cache->tags($this->tags);
            }

            return $cache->get($cacheKey);
        }

        $result = $callback();

        if (! empty($this->tags)) {
            $cache = $cache->tags($this->tags);
        }

        $cache->put($cacheKey, $result, $this->getCacheTtl());

        return $result;
    }
}
