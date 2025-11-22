<?php
use App\Models\ProjectRequest;
use App\Models\StudyRequest;
use App\Policies\ProjectRequestPolicy;
use App\Policies\StudyRequestPolicy;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        ProjectRequest::class => ProjectRequestPolicy::class,
        StudyRequest::class   => StudyRequestPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}