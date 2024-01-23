{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Sportsmens" icon="la la-question" :link="backpack_url('sportsmen')" />
<x-backpack::menu-item title="Competitions" icon="la la-question" :link="backpack_url('competitions')" />
<x-backpack::menu-item title="Regulations" icon="la la-question" :link="backpack_url('regulations')" />