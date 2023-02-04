<?php

namespace Mrpath\Shop\Http\Middleware;

use Closure;
use Mrpath\Core\Repositories\LocaleRepository;

class Locale
{
    /**
     * Locale repository instance.
     *
     * @var \Mrpath\Core\Repositories\LocaleRepository
     */
    protected $localeRepository;

    /**
     * Create a middleware instance.
     *
     * @param  \Mrpath\Core\Repositories\LocaleRepository  $localeRepository
     * @return void
     */
    public function __construct(LocaleRepository $localeRepository)
    {
        $this->localeRepository = $localeRepository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($localeCode = core()->getRequestedLocaleCode('locale', false)) {
            if ($this->localeRepository->findOneByField('code', $localeCode)) {
                app()->setLocale($localeCode);

                session()->put('locale', $localeCode);
            }
        } else {
            if ($localeCode = session()->get('locale')) {
                app()->setLocale($localeCode);
            } else {
                app()->setLocale(core()->getDefaultChannel()->default_locale->code);
            }
        }

        unset($request['locale']);

        return $next($request);
    }
}
