<?php

namespace App\Services\PaymentGateways\Contracts;

use App\Domains\Entity\Enums\EntityEnum;
use App\Domains\Entity\Facades\Entity;
use App\Models\Plan;
use App\Models\User;
use App\Services\BusinessCreditService;
use Exception;

trait CreditUpdater
{
    public static function creditIncreaseSubscribePlan(?User $user, Plan $plan): void
    {
        // Add AI credits
        $modelsCredit = $plan->getAttribute('ai_models');
        foreach ($modelsCredit as $modelsGroup) {
            foreach ($modelsGroup as $model => $credit) {
                $driver = Entity::driver(EntityEnum::fromSlug($model))->forUser($user);
                $driver->increaseCredit($credit['credit']);
                $driver->setAsUnlimited($credit['isUnlimited']);
            }
        }
        
        // Add business credits
        if ($user) {
            BusinessCreditService::addCreditsFromPlan($user, $plan);
        }
    }

    /**
     * @throws Exception
     */
    public static function creditDecreaseCancelPlan(User $user, Plan $plan): void
    {
        $modelsCredit = $plan->getAttribute('ai_models');
        foreach ($modelsCredit as $modelsGroup) {
            foreach ($modelsGroup as $model => $credit) {
                $driver = Entity::driver(EntityEnum::fromSlug($model))->forUser($user);
                $driver->setAsUnlimited(false);
                $driver->decreaseCredit($credit['credit']);
            }
        }
    }
}
