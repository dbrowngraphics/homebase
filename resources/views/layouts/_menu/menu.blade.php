<!-- <ul id="menu"> -->
    
<ul id="js-nav-menu" class="nav-menu">
<!--     <li id="menu-search"><a href="javascript: void(0);"><i class="fa fa-lg fa-fw fa-search"></i> <span class="menu-item-parent"><input type="text" id="menu_filter"/></span></a></li> -->
@foreach($menuItems as $menuItem)

    @php
        $menuURL = ('#' == $menuItem['url']) ? 'javascript:void(0)' : '//' . $_SERVER['SERVER_NAME'] . $_SERVER['CONTEXT_PREFIX'] . '/' . $menuItem['url'];
        $hiddenParent = ('0' == $menuItem['visible']) ? 'hidden' : '';
    @endphp

    <li {{ $hiddenParent }}>
        <a href="{{ $menuURL }}" ><i class="fal fa-lg fa-fw fa-{{ $menuItem['icon'] }}"></i><span class="nav-link-text">{{ $menuItem['title'] }}</span></a>

        @if(count($menuItem['submenu']) > 0)
        <ul class="nav-menu">
            @foreach($menuItem['submenu'] as $menu)
                @php
                    $hiddenChild = ('' == $hiddenParent && '1' == $menu['visible']) ? '' : 'hidden';
                @endphp

                <li {{ $hiddenChild }}>
                    <a href="{{ '//' . $_SERVER['SERVER_NAME'] . $_SERVER['CONTEXT_PREFIX'] . '/' . $menu['url'] }}" ><i class="fal fa-lg fa-fw fa-{{ $menu['icon'] }}"></i><span class="nav-link-text">{{ $menu['title'] }}</span></a>
                </li>

            @endforeach
        </ul>
        @endif
    </li>
@endforeach
</ul>


@push('scripts')
<!-- <script>
    let menuItems = $('#menu li').not('#menu-search');
    let menu = $('#menu_filter');

    let filter_menu = function () {
        $.each(menuItems, function(){
            if(menu.val().length > 0) {
                $(this).find('a').text().toLowerCase().indexOf(menu.val().toLowerCase()) !== -1 ?
                    $(this).show() : $(this).hide();
            }else{
                menuItems.show();
            }
        });
    };

    menu.on('keyup', function(){
        filter_menu();
    });
</script> -->
@endpush