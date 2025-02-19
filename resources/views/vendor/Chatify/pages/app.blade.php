@include('Chatify::layouts.headLinks')
<div class="messenger">
    {{-- ----------------------Users/Groups lists side---------------------- --}}
    <div class="messenger-listView {{ !!$id ? 'conversation-active' : '' }}">
        {{-- Header and search bar --}}
        <div class="m-header">
            <nav>
                <a href="#"><i class="fas fa-inbox"></i> <span class="messenger-headTitle">MESSAGES</span></a>
                <nav class="m-header-right">
                    <a href="#"><i class="fas fa-cog settings-btn"></i></a>
                    <a href="#" class="listView-x"><i class="fas fa-times"></i></a>
                </nav>
            </nav>
            <input type="text" class="messenger-search" placeholder="Search" />
        </div>

        {{-- Tabs and lists --}}
        <div class="m-body contacts-container">
           <div class="show messenger-tab users-tab app-scroll" data-view="users">
               {{-- Favorites --}}
               <div class="favorites-section">
                   <p class="messenger-title"><span>Favorites</span></p>
                   <div class="messenger-favorites app-scroll-hidden"></div>
               </div>
               
               {{-- Saved Messages --}}
               <p class="messenger-title"><span>Your Space</span></p>
               {!! view('Chatify::layouts.listItem', ['get' => 'saved']) !!}

               {{-- Contact --}}
               <p class="messenger-title"><span>All Messages</span></p>
                <div class="listOfContacts" style="width: 100%;height: calc(100% - 272px);position: relative;">
                    {{-- Admin selalu ditampilkan di daftar kontak --}}
                    @php
                        use App\Models\User;
                        $admin = User::where('role', 'admin')->first();
                    @endphp
                    @if($admin)
                        <div class="chatify-d-flex contact-item" data-contact="{{ $admin->id }}">
                            <p>{{ $admin->name }}</p>
                        </div>
                    @else
                        <p style="color: red; text-align: center;">Admin tidak ditemukan!</p>
                    @endif
                </div>
           </div>

           {{-- Search Tab --}}
           <div class="messenger-tab search-tab app-scroll" data-view="search">
                <p class="messenger-title"><span>Search</span></p>
                <div class="search-records">
                    <p class="message-hint center-el"><span>Type to search..</span></p>
                </div>
           </div>
        </div>
    </div>

    {{-- ----------------------Messaging side---------------------- --}}
    <div class="messenger-messagingView">
        <div class="m-header m-header-messaging">
            <nav class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                <div class="chatify-d-flex chatify-justify-content-between chatify-align-items-center">
                    <a href="#" class="show-listView"><i class="fas fa-arrow-left"></i></a>
                    <div class="avatar av-s header-avatar"></div>
                    <a href="#" class="user-name">{{ config('chatify.name') }}</a>
                </div>
                <nav class="m-header-right">
                    <a href="#" class="add-to-favorite"><i class="fas fa-star"></i></a>
                    <a href="/"><i class="fas fa-home"></i></a>
                    <a href="#" class="show-infoSide"><i class="fas fa-info-circle"></i></a>
                </nav>
            </nav>
        </div>

        {{-- Messaging area --}}
        <div class="m-body messages-container app-scroll">
            <div class="messages">
                <p class="message-hint center-el"><span>Please select a chat to start messaging</span></p>
            </div>
        </div>
        
        {{-- Send Message Form --}}
        @include('Chatify::layouts.sendForm')
    </div>

    {{-- ---------------------- Info side ---------------------- --}}
    <div class="messenger-infoView app-scroll">
        <nav>
            <p>User Details</p>
            <a href="#"><i class="fas fa-times"></i></a>
        </nav>
        {!! view('Chatify::layouts.info')->render() !!}
    </div>
</div>

@include('Chatify::layouts.modals')
@include('Chatify::layouts.footerLinks')
