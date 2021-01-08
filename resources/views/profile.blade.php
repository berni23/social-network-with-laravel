@extends('layouts/app')

@section('head')

    <script src="{{ mix('js/post.js') }}" defer></script>
        <script defer>

  window.onload =function(){
          var main = document.querySelector('main');
          var profileHeight = document.querySelector('.profile').offsetHeight+20;
          main.style.marginTop=profileHeight + 'px';
  }

        </script>

@endsection
@section('profile')
            <div class="flex md:flex-row-reverse flex-wrap">
                <div class="text-profile w-full md:w-3/4 p-4 text-center">
                    <div class="text-left pl-4 pt-3">
                        <span class="text-base text-gray-700 text-2xl mr-2">{{ $user->name }}</span>
                    </div>
                    <div class="text-left pl-4 pt-3">

                        <span class="text-base font-semibold text-gray-700 mr-2">

                             @if(!$user->numPosts)  No Posts yet
                             @else  <b>{{$user->numPosts}}</b> posts
                             @endif

                        </span>
                        <span class="text-base font-semibold text-gray-700 mr-2">
                              @if(!$user->numFriends) No friends yet
                              @else  <b>{{$user->numFriends}}</b> friends
                              @endif
                        </span>

                    </div>

                    <div class="text-left pl-4 pt-3">
                        <span class="text-lg font-bold text-gray-700 mr-2">About me</span>
                    </div>

                    <div class="description text-left pl-4 pt-3">
                        <p class="text-base font-medium text-gray-700 mr-2">{{$user->description}}</p>
                        <br>
                        <br>
                        <p class="text-base font-medium text-blue-700 mr-2">#graphicsdesigner #traveller #reader #blogger
                            #digitalmarketer</p>
                    </div>
                </div>

                <div class="w-full md:w-1/4 p-4 text-center">
                    <div class="w-full relative md:w-3/4 text-center mt-8">
                        <button class="flex rounded-full" id="user-menu" aria-label="User menu" aria-haspopup="true">
                            <img class="rounded-full profile_photo_url" src="{{ $user->profile_photo_url }}" />
                        </button>

                        {{-- <div><span>settings</span> <i class ="fa fa cog"><i></div> --}}
                    </div>
                </div>
            </div>

            <!--status show icon-->

            <hr class="border-gray-500 mt-12" />

            <!--post icon and title-->
            <div class="flex flex-row mt-4 justify-center mr-16">
                <div class="flex text-gray-700 text-center py-2 m-2 pr-5">
                    <div class="flex inline-flex">
                        <button id="userPosts"
                            class="border-transparent text-gray-800 rounded-full hover:text-blue-600 focus:outline-none focus:text-gray-600"
                            aria-label="Notifications">
                            <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex inline-flex ml-2 mt-1">
                        <h3 class="text-sm font-bold text-gray-800 mr-2">POSTS</h3>
                    </div>
                </div>
                <div class="flex text-gray-700 text-center py-2 m-2 pr-5">
                    <div class="flex inline-flex">
                        <button
                            class="border-transparent text-gray-600 rounded-full hover:text-blue-600 focus:outline-none focus:text-gray-600"
                            aria-label="Notifications">
                            <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex inline-flex ml-2 mt-1">
                        <h3 class="text-sm font-medium text-gray-700 mr-2">IGTV</h3>
                    </div>
                </div>

                <div class="flex text-gray-700 text-center py-2 m-2 pr-5">
                    <div class="flex inline-flex">
                        <button
                            class="border-transparent text-gray-600 rounded-full hover:text-blue-600 focus:outline-none focus:text-gray-600"
                            aria-label="Notifications">
                            <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex inline-flex ml-2 mt-1">
                        <h3 class="text-sm font-medium text-gray-700 mr-2">SAVED</h3>
                    </div>
                </div>

                <div class="flex text-gray-700 text-center py-2 m-2 pr-5">
                    <div class="flex inline-flex">
                        <button
                            class="border-transparent text-gray-600 rounded-full hover:text-blue-600 focus:outline-none focus:text-gray-600"
                            aria-label="Notifications">
                            <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex inline-flex ml-2 mt-1">
                        <h3 class="text-sm font-medium text-gray-700 mr-2">TAGGED</h3>
                    </div>
                </div>
            </div>
@endsection

@section('modals')
    <!--Modal create comment-->
     @include('components.modalComment')
    <!-- Modal Confirm delete -->
     @include('components.modalDelete')
     <div class = "hidden" id="group" data-group="user"></div>

@endsection


