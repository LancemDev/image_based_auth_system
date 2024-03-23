<div class="container mx-auto max-w-md">
<x-stat title="Messages" value="44" icon="o-envelope" tooltip="Hello" />
 
<x-stat
    title="Sales"
    description="This month"
    value="22.124"
    icon="o-arrow-trending-up"
    tooltip-bottom="There" />
 
<x-stat
    title="Lost"
    description="This month"
    value="34"
    icon="o-arrow-trending-down"
    tooltip-left="Ops!" />
 
<x-stat
    title="Sales"
    description="This month"
    value="22.124"
    icon="o-arrow-trending-down"
    class="text-orange-500"
    color="text-pink-500"
    tooltip-right="Gosh!" />

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-menu>
            <x-menu-item title="Logout" icon="s-chevron-left" onclick="event.preventDefault(); this.closest('form').submit();" />
        </x-menu>
    </form>
</div>
