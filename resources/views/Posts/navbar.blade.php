<nav class="nav_menu float_r fixed_nav_menu">
    <h3 class="screen-reader-text">Explore</h3>
    <ul id="menu-explore" class="menu">
        <li id="menu-item-90" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home  page_item page-item-64  menu-item-90"><a class=""  href="{{route('homepage')}}"><i class="icon-home"></i>Home</a></li>
        <li id="menu-item-177" class="wpqa-menu wpqa-add-group-nav menu-item menu-item-type-custom menu-item-object-custom <?php if(isset($i) && $i==99) echo "current_page_item" ?>  menu-item-177 li-add-group"><a class=""  href="http://template.test/add-group/"><i class="icon-network"></i>Add group</a></li>

        <li id="menu-item-91" class="wpqa-menu wpqa-profile-nav menu-item menu-item-type-custom menu-item-object-custom <?php if(isset($i) && ($i==0 || $i==34 || $i==35 || $i==36 || $i==37 )) echo "current_page_item" ?>  menu-item-91 li-profile"><a class=""  href="{{route('userprofile',[\Illuminate\Support\Facades\Auth::user()->id])}}"><i class="icon-vcard"></i>User Profile</a></li>

        <li id="menu-item-94" class="nav_menu_open menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children <?php if(isset($i) && ($i==2 || $i==5 || $i==4 || $i==6) ) echo "current_page_item" ?>  menu-item-94"><a class=""  href="http://template.test/questions/"><i class="icon-book-open"></i>Questions</a>
            <ul class="sub-menu">
                <li id="menu-item-95" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-95"><a class=""  href="{{route('QuestionBody')}}">Recent Questions</a></li>
                <li id="menu-item-96" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-96"><a class=""  href="{{route('answered')}}">Answered Questions</a></li>
                <li id="menu-item-97" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-97"><a class=""  href="{{route('Most_Voted')}}">Popular Questions</a></li>
                <li id="menu-item-98" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-98"><a class=""  href="{{route('Not_answered')}}">Not answered Questions</a></li>
            </ul>
        </li>
        <li id="menu-item-94" class="nav_menu_open menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children <?php if(isset($i) && ($i==7 || $i==13 || $i==14 || $i==15) ) echo "current_page_item" ?> menu-item-94"><a class=""  href="http://template.test/questions/"><i class="icon-newspaper"></i>Posts</a>
            <ul class="sub-menu">
                <li id="menu-item-95" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-95"><a class=""  href="{{route('postsBody')}}">Recent Posts</a></li>
                <li id="menu-item-96" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-96"><a class=""  href="{{route('VotedPosts')}}">Popular Posts</a></li>
                <li id="menu-item-97" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-97"><a class=""  href="{{route('experiences')}}">Experiences</a></li>
                <li id="menu-item-98" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-98"><a class=""  href="{{route('services')}}">Services</a></li>
            </ul>
        </li>

        @if(\Illuminate\Support\Facades\Auth::user()->useable_type=="Teacher")
        <li id="menu-item-94" class="nav_menu_open menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children <?php if( isset($i) && ($i==16 || $i==17 || $i==20 || $i==19) ) echo "current_page_item" ?> menu-item-94"><a class=""  href="http://template.test/questions/"><i class="icon-book-open"></i>Private Questions</a>
            <ul class="sub-menu">
                <li id="menu-item-95" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-95"><a class=""  href="{{route('QuestionProfessors')}}">Recent Questions</a></li>
                <li id="menu-item-96" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-96"><a class=""  href="{{route('answered_p')}}">Answered Questions</a></li>
                <li id="menu-item-97" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-97"><a class=""  href="{{route('Most_Voted_p')}}">Popular Questions</a></li>
                <li id="menu-item-98" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-98"><a class=""  href="{{route('Not_answered_p')}}">Not answered Questions</a></li>
            </ul>
        </li>
        <li id="menu-item-94" class="nav_menu_open menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children <?php if(isset($i) && ( $i==21 || $i==23 || $i==24 || $i==25 )) echo "current_page_item" ?> menu-item-94"><a class=""  href="http://template.test/questions/"><i class="icon-newspaper"></i>Private Posts</a>
            <ul class="sub-menu">
                <li id="menu-item-95" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-95"><a class=""  href="{{route('postsProfessors')}}">Recent Posts</a></li>
                <li id="menu-item-96" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-96"><a class=""  href="{{route('VotedPosts_p')}}">Popular Posts</a></li>
                <li id="menu-item-97" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-97"><a class=""  href="{{route('experiences_p')}}">Experiences</a></li>
                <li id="menu-item-98" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-98"><a class=""  href="{{route('services_p')}}">Services</a></li>
            </ul>
        </li>
        @endif
        <li id="menu-item-101" class="menu-item menu-item-type-post_type menu-item-object-page  <?php if(isset($i) && $i==26 ) echo "current_page_item" ?> menu-item-101"><a class=""  href="{{route('users')}}"><i class="icon-users"></i>Users</a></li>
        <li id="menu-item-103" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-103"><a class=""  href="{{route('contact')}}"><i class="icon-lifebuoy"></i>Help</a></li>

    </ul>
</nav><!-- End nav_menu -->
