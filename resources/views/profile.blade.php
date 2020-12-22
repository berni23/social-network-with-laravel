<x-app-layout>

    <div class="w-full flex flex-row flex-wrap">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        .round {
        border-radius: 50%;
        }
        </style>
  
  
        <div class="w-full bg-indigo-100 h-screen flex flex-row flex-wrap justify-center ">
    
            <!-- Begin Navbar -->
    
            <div class="bg-white shadow-lg border-t-4 border-indigo-500 absolute bottom-0 w-full md:w-0 md:hidden flex flex-row flex-wrap">
                <div class="w-full text-right"><button class="p-2 fa fa-bars text-4xl text-gray-600"></button></div>
            </div>
    
            <div class="w-0 md:w-1/4 lg:w-1/5 h-0 md:h-screen overflow-y-hidden bg-white shadow-lg">
                <div class="p-5 bg-white sticky top-0">
                    <img class="border border-indigo-100 shadow-lg round" src="http://lilithaengineering.co.za/wp-content/uploads/2017/08/person-placeholder.jpg">
                    <div class="pt-2 border-t mt-5 w-full text-center text-xl text-gray-600">
                        Some Person
                    </div>
                </div>
                <div class="w-full h-screen antialiased flex flex-col hover:cursor-pointer">
                    <a class="hover:bg-gray-300 bg-gray-200 border-t-2 p-3 w-full text-xl text-left text-gray-600 font-semibold" href=""><i class="fa fa-comment text-gray-600 text-2xl pr-1 pt-1 float-right"></i>Messages</a>
                    <a class="hover:bg-gray-300 bg-gray-200 border-t-2 p-3 w-full text-xl text-left text-gray-600 font-semibold" href=""><i class="fa fa-cog text-gray-600 text-2xl pr-1 pt-1 float-right"></i>Settings</a>
                    <a class="hover:bg-gray-300 bg-gray-200 border-t-2 p-3 w-full text-xl text-left text-gray-600 font-semibold" href=""><i class="fa fa-arrow-left text-gray-600 text-2xl pr-1 pt-1 float-right"></i>Log out</a>
                </div>
            </div>
    
            <!-- End Navbar -->
    
            <div class="w-full md:w-3/4 lg:w-4/5 p-5 md:px-12 lg:24 h-full overflow-x-scroll antialiased">
                <div class="bg-white w-full shadow rounded-lg p-5">
                    <textarea class="bg-gray-200 w-full rounded-lg shadow border p-2" rows="5" placeholder="Speak your mind"></textarea>
        
                    <div class="w-full flex flex-row flex-wrap mt-3">
                        <div class="w-1/3">
                            <select class="w-full p-2 rounded-lg bg-gray-200 shadow border float-left">
                                option>Public</option>
                                <option>Private</option>
                            </select>
                        </div>
                        <div class="w-2/3">
                            <button type="button" class="float-right bg-indigo-400 hover:bg-indigo-300 text-white p-2 rounded-lg">Submit</button>
                        </div>
                    </div>
                </div>
      
                <div class="mt-3 flex flex-col">
        
        
                <div class="bg-white mt-3">
                    <img class="border rounded-t-lg shadow-lg " src="https://images.unsplash.com/photo-1572817519612-d8fadd929b00?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80">
                    <div class="bg-white border shadow p-5 text-xl text-gray-700 font-semibold">
                        A Pretty Cool photo from the mountains. Image credit to @danielmirlea on Unsplash.
                    </div>
                    <div class="bg-white p-1 border shadow flex flex-row flex-wrap">
                    <div class="w-1/3 hover:bg-gray-200 text-center text-xl text-gray-700 font-semibold">Like</div>
                    <div class="w-1/3 hover:bg-gray-200 border-l-4 border-r- text-center text-xl text-gray-700 font-semibold">Share</div>
                    <div class="w-1/3 hover:bg-gray-200 border-l-4 text-center text-xl text-gray-700 font-semibold">Comment</div>
                </div>
          
                <div class="bg-white border-4 bg-gray-300 border-white rounded-b-lg shadow p-5 text-xl text-gray-700 content-center font-semibold flex flex-row flex-wrap">
                    <div class="w-full">
                        <div class="w-full text-left text-xl text-gray-600">
                            @Some Person
                        </div>
                        A Pretty Cool photo from the mountains. Image credit to @danielmirlea on Unsplash.
                        A Pretty Cool photo from the mountains. Image credit to @danielmirlea on Unsplash.
                    </div>
                </div>
            </div>
        
        
            <div class="bg-white mt-3">
                <img class="border rounded-t-lg shadow-lg " src="https://images.unsplash.com/photo-1572817519612-d8fadd929b00?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80">
                <div class="bg-white border shadow p-5 text-xl text-gray-700 font-semibold">
                    A Pretty Cool photo from the mountains. Image credit to @danielmirlea on Unsplash.
                </div>
                <div class="bg-white p-1 rounded-b-lg border shadow flex flex-row flex-wrap">
                    <div class="w-1/3 hover:bg-gray-200 text-center text-xl text-gray-700 font-semibold">Like</div>
                    <div class="w-1/3 hover:bg-gray-200 border-l-4 border-r- text-center text-xl text-gray-700 font-semibold">Share</div>
                    <div class="w-1/3 hover:bg-gray-200 border-l-4 text-center text-xl text-gray-700 font-semibold">Comment</div>
                </div>
            </div>
        
        
            <div class="bg-white mt-3">
                <img class="border rounded-t-lg shadow-lg " src="https://images.unsplash.com/photo-1572817519612-d8fadd929b00?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80">
                <div class="bg-white border shadow p-5 text-xl text-gray-700 font-semibold">
                    A Pretty Cool photo from the mountains. Image credit to @danielmirlea on Unsplash.
                    </div>
                        <div class="bg-white p-1 rounded-b-lg border shadow flex flex-row flex-wrap">
                            <div class="w-1/3 hover:bg-gray-200 text-center text-xl text-gray-700 font-semibold">Like</div>
                            <div class="w-1/3 hover:bg-gray-200 border-l-4 border-r- text-center text-xl text-gray-700 font-semibold">Share</div>
                            <div class="w-1/3 hover:bg-gray-200 border-l-4 text-center text-xl text-gray-700 font-semibold">Comment</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
