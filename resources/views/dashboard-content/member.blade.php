<h3>member dashboard</h3>


@IsAvailable(strtotime(date('h:i A', time())))
    <h4>Here are some of the available Meals to order</h4>
    <button class="btn btn-primary w-100 meal-select-prompt" data-bs-toggle="modal" data-bs-target="#meal-select-confirmation"
        data-meal-value="{{ $plan->meal_plan_id }}" @if ($hasOrdered == true) disabled @endif>
        @if ($hasOrdered != null)
            @if ($hasOrdered == true)
                Ordered
            @endif
        @else
            Order
        @endif
    </button>
@ElseIsAvailable
    <button class="btn btn-primary w-100 text-uppercase" disabled>
        Service unavailable
    </button>
@EndIsAvailable
