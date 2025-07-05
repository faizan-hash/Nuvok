<<<<<<< HEAD
<?php

namespace App\Services;

use App\Models\BusinessCredit;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BusinessCreditService
{
    /**
     * Add business credits to user when they purchase a plan
     */
    public static function addCreditsFromPlan(User $user, Plan $plan): void
    {
        $businessCredit = $user->businessCredits()->firstOrCreate(['user_id' => $user->id], [
            'invoices' => 0,
            'clients' => 0,
            'projects' => 0,
            'tasks' => 0,
        ]);

        // Get dynamic business credits based on plan price
        $planCredits = $plan->getBusinessCreditsByPrice();

        $businessCredit->increment('invoices', $planCredits['invoices']);
        $businessCredit->increment('clients', $planCredits['clients']);
        $businessCredit->increment('projects', $planCredits['projects']);
        $businessCredit->increment('tasks', $planCredits['tasks']);
    }

    /**
     * Check if user has enough credits for a specific action
     */
    public static function hasCredits(User $user, string $type, int $amount = 1): bool
    {
        $businessCredit = $user->businessCredits;
        
        if (!$businessCredit) {
            return false;
        }

        return match($type) {
            'invoices' => $businessCredit->invoices >= $amount,
            'clients' => $businessCredit->clients >= $amount,
            'projects' => $businessCredit->projects >= $amount,
            'tasks' => $businessCredit->tasks >= $amount,
            default => false,
        };
    }

    /**
     * Consume credits for a specific action
     */
    public static function consumeCredits(User $user, string $type, int $amount = 1): bool
    {
        if (!self::hasCredits($user, $type, $amount)) {
            return false;
        }

        $businessCredit = $user->businessCredits;
        
        return DB::transaction(function () use ($businessCredit, $type, $amount) {
            switch ($type) {
                case 'invoices':
                    $businessCredit->decrement('invoices', $amount);
                    break;
                case 'clients':
                    $businessCredit->decrement('clients', $amount);
                    break;
                case 'projects':
                    $businessCredit->decrement('projects', $amount);
                    break;
                case 'tasks':
                    $businessCredit->decrement('tasks', $amount);
                    break;
                default:
                    return false;
            }
            
            return true;
        });
    }

    /**
     * Get remaining credits for a user
     */
    public static function getRemainingCredits(User $user): array
    {
        $businessCredit = $user->businessCredits;
        
        if (!$businessCredit) {
            return [
                'invoices' => 0,
                'clients' => 0,
                'projects' => 0,
                'tasks' => 0,
            ];
        }

        return [
            'invoices' => $businessCredit->invoices,
            'clients' => $businessCredit->clients,
            'projects' => $businessCredit->projects,
            'tasks' => $businessCredit->tasks,
        ];
    }

    /**
     * Initialize business credits for a new user
     */
    public static function initializeCredits(User $user, int $defaultCredits = 5): void
    {
        $user->businessCredits()->firstOrCreate(['user_id' => $user->id], [
            'invoices' => $defaultCredits,
            'clients' => $defaultCredits,
            'projects' => $defaultCredits,
            'tasks' => $defaultCredits,
        ]);
    }
=======
<?php

namespace App\Services;

use App\Models\BusinessCredit;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BusinessCreditService
{
    /**
     * Add business credits to user when they purchase a plan
     */
    public static function addCreditsFromPlan(User $user, Plan $plan): void
    {
        $businessCredit = $user->businessCredits()->firstOrCreate(['user_id' => $user->id], [
            'invoices' => 0,
            'clients' => 0,
            'projects' => 0,
            'tasks' => 0,
        ]);

        // Get dynamic business credits based on plan price
        $planCredits = $plan->getBusinessCreditsByPrice();

        $businessCredit->increment('invoices', $planCredits['invoices']);
        $businessCredit->increment('clients', $planCredits['clients']);
        $businessCredit->increment('projects', $planCredits['projects']);
        $businessCredit->increment('tasks', $planCredits['tasks']);
    }

    /**
     * Check if user has enough credits for a specific action
     */
    public static function hasCredits(User $user, string $type, int $amount = 1): bool
    {
        $businessCredit = $user->businessCredits;
        
        if (!$businessCredit) {
            return false;
        }

        return match($type) {
            'invoices' => $businessCredit->invoices >= $amount,
            'clients' => $businessCredit->clients >= $amount,
            'projects' => $businessCredit->projects >= $amount,
            'tasks' => $businessCredit->tasks >= $amount,
            default => false,
        };
    }

    /**
     * Consume credits for a specific action
     */
    public static function consumeCredits(User $user, string $type, int $amount = 1): bool
    {
        if (!self::hasCredits($user, $type, $amount)) {
            return false;
        }

        $businessCredit = $user->businessCredits;
        
        return DB::transaction(function () use ($businessCredit, $type, $amount) {
            switch ($type) {
                case 'invoices':
                    $businessCredit->decrement('invoices', $amount);
                    break;
                case 'clients':
                    $businessCredit->decrement('clients', $amount);
                    break;
                case 'projects':
                    $businessCredit->decrement('projects', $amount);
                    break;
                case 'tasks':
                    $businessCredit->decrement('tasks', $amount);
                    break;
                default:
                    return false;
            }
            
            return true;
        });
    }

    /**
     * Get remaining credits for a user
     */
    public static function getRemainingCredits(User $user): array
    {
        $businessCredit = $user->businessCredits;
        
        if (!$businessCredit) {
            return [
                'invoices' => 0,
                'clients' => 0,
                'projects' => 0,
                'tasks' => 0,
            ];
        }

        return [
            'invoices' => $businessCredit->invoices,
            'clients' => $businessCredit->clients,
            'projects' => $businessCredit->projects,
            'tasks' => $businessCredit->tasks,
        ];
    }

    /**
     * Initialize business credits for a new user
     */
    public static function initializeCredits(User $user, int $defaultCredits = 5): void
    {
        $user->businessCredits()->firstOrCreate(['user_id' => $user->id], [
            'invoices' => $defaultCredits,
            'clients' => $defaultCredits,
            'projects' => $defaultCredits,
            'tasks' => $defaultCredits,
        ]);
    }
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
} 