<!-- <ul id="menu"> -->
    
<ul id="js-nav-menu" class="nav-menu">
<!--     <li id="menu-search"><a href="javascript: void(0);"><i class="fa fa-lg fa-fw fa-search"></i> <span class="menu-item-parent"><input type="text" id="menu_filter"/></span></a></li> -->
@foreach($menuItems as $menuItem)
    <li visible="{{$menuItem->visible}}">
        <a href="{{$menuItem->url}}" {{$menuItem->external}}><i class="fal fa-lg fa-fw fa-{{$menuItem->icon}}"></i> <span class="menu-item-parent">{{$menuItem->title}}</span></a>
    </li>
@endforeach
</ul>
@push('scripts')
<script>
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
</script>
@endpush