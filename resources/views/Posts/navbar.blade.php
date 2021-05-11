<nav class="nav_menu float_r fixed_nav_menu">
    <h3 class="screen-reader-text">Explore</h3>
    <ul id="menu-explore" class="menu"><li id="menu-item-90" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-64 current_page_item menu-item-90"><a class=""  href="http://template.test/"><i class="icon-home"></i>Home</a></li>
        <li id="menu-item-177" class="wpqa-menu wpqa-add-group-nav menu-item menu-item-type-custom menu-item-object-custom menu-item-177 li-add-group"><a class=""  href="http://template.test/add-group/"><i class="icon-network"></i>Add group</a></li>

        <li id="menu-item-91" class="wpqa-menu wpqa-profile-nav menu-item menu-item-type-custom menu-item-object-custom menu-item-91 li-profile"><a class=""  href="{{route('userprofile',[\Illuminate\Support\Facades\Auth::user()->id])}}"><i class="icon-vcard"></i>User Profile</a></li>

        <li id="menu-item-94" class="nav_menu_open menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-94"><a class=""  href="http://template.test/questions/"><i class="icon-book-open"></i>Questions</a>
            <ul class="sub-menu">
                <li id="menu-item-95" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-95"><a class=""  href="{{route('QuestionBody')}}">Recent Questions</a></li>
                <li id="menu-item-96" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-96"><a class=""  href="{{route('answered')}}">Answered Questions</a></li>
                <li id="menu-item-97" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-97"><a class=""  href="{{route('Most_Voted')}}">Popular Questions</a></li>
                <li id="menu-item-98" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-98"><a class=""  href="{{route('Not_answered')}}">Not answered Questions</a></li>
            </ul>
        </li>
        <li id="menu-item-94" class="nav_menu_open menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-94"><a class=""  href="http://template.test/questions/"><i class="icon-newspaper"></i>Posts</a>
            <ul class="sub-menu">
                <li id="menu-item-95" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-95"><a class=""  href="{{route('postsBody')}}">Recent Posts</a></li>
                <li id="menu-item-96" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-96"><a class=""  href="{{route('VotedPosts')}}">Popular Posts</a></li>
                <li id="menu-item-97" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-97"><a class=""  href="{{route('experiences')}}">Experiences</a></li>
                <li id="menu-item-98" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-98"><a class=""  href="{{route('services')}}">Services</a></li>
            </ul>
        </li>
        <li id="menu-item-102" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-102"><a class=""  href="http://template.test/badges/"><i class="icon-trophy"></i>Badges</a></li>
        <li id="menu-item-101" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-101"><a class=""  href="{{route('users')}}"><i class="icon-users"></i>Users</a></li>
        <li id="menu-item-103" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-103"><a class=""  href="{{route('contact')}}"><i class="icon-lifebuoy"></i>Help</a></li>

    </ul>
</nav><!-- End nav_menu -->
