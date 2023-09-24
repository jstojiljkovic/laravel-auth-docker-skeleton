<?php

namespace App\Interfaces\Services;

use Illuminate\Http\RedirectResponse;

interface SocialServiceInterface
{
    /**
     * @param string $provider
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse
     */
    public function redirectToProvider(string $provider): \Symfony\Component\HttpFoundation\RedirectResponse|RedirectResponse;

    /**
     * @param string $provider
     *
     * @return array
     */
    public function handleProviderCallback(string $provider): array;
}
