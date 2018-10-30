<div class="sidebar" data-active-color="rose" data-background-color="black" data-image="{{ asset('img/sidebar-1.jpg') }}">
    <!--
Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
Tip 2: you can also add an image using data-image tag
Tip 3: you can change the color of the sidebar with data-background-color="white | black"
-->
    <div class="logo">
        <a href="http://www.facebook.com/misview" class="simple-text logo-mini">
            MC
        </a>
        <a href="http://www.facebook.com/misview" class="simple-text logo-normal">
            MIS Community
        </a>
    </div>
    <div class="sidebar-wrapper">
        @if(!Auth::guest())
        <div class="user">
            <div class="photo">
                <img src="{{ asset('img/default-avatar.png') }}"/>
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    <span>
                        {{ auth()->user()->name }}
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        
                        <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" style="text-decoration:none;">
                                    <span class="sidebar-mini">L</span>
                                    <span class="sidebar-normal">लग आउट गर्नुहोस्</span>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                                </a>
                            </li>
                    </ul>
                </div>
            </div>
        </div>
        @endif
        @if (!Auth::guest())
        <ul class="nav">
            <li class="active">
                <a href="/home">
                    <i class="material-icons"></i>
                    <p><b>ड्यासबोर्ड</b></p>
                </a>
            </li>
           
            <li class="">
                    <a href="/change-fat">
                        <i class="material-icons"></i>
                        <p><b>फ्याटको मुल्य परिवर्तन गर्नुहोस्</b></p>
                    </a>
                </li>

                    <li>
                            <a data-toggle="collapse" href="#customer">
                                <i class="material-icons"></i>
                                <p><b>ग्राहक</b>
                                    <b class="caret"></b>
                                </p>
                            </a>
                          
                            <div class="collapse" id="customer">
                                    <ul class="nav">
                                        <li>
                                            <a href="/add-customer">
                                                <span class="sidebar-mini">AC</span>
                                                <span class="sidebar-normal">नयाँ ग्राहक थप्नुहोस</span>
                                            </a>
                                        </li>
                                        <li>
                                                <a href="/manage-customer">
                                                    <span class="sidebar-mini">UP</span>
                                                    <span class="sidebar-normal">ग्राहक ब्यबस्थापन गर्नुहोस्</span>
                                                </a>
                                            </li>
                                    </ul>
                                </div>
            
                        </li>
            
            <li>
                    <a data-toggle="collapse" href="#news">
                        <i class="material-icons"></i>
                        <p><b>आजको दुध हाल्नुहोस</b>
                            <b class="caret"></b>
                        </p>
                    </a>
                  
                    <div class="collapse" id="news">
                            <ul class="nav">
                                <li>
                                    <a href="/add-morning-milk">
                                        <span class="sidebar-mini">MM</span>
                                        <span class="sidebar-normal">बिहानको दुध</span>
                                    </a>
                                </li>
                                <li>
                                        <a href="/add-evening-milk">
                                            <span class="sidebar-mini">EM</span>
                                            <span class="sidebar-normal">बेलुकाको दुध</span>
                                        </a>
                                    </li>
                            </ul>
                        </div>
    
                </li>

                <li class="">
                        <a href="/see-milk">
                            <i class="material-icons"></i>
                            <p><b>आजको दुध हेर्नुहोस्</b></p>
                        </a>
                    </li>

                <li class="">
                        <a href="/calculate-my-money">
                            <i class="material-icons"></i>
                            <p><b>हिसाब गर्नुहोस्</b></p>
                        </a>
                    </li>
            
                    <li class="">
                        <a href="/history">
                            <i class="material-icons"></i>
                            <p><b>पुरानो हिसाब हेर्नुहोस्</b></p>
                        </a>
                    </li>
             
        </ul>
        @endif
    </div>
</div>