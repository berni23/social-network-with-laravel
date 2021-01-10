   <!-- Modal answer request -->

   <div id="modalRequest"
       class="z-50 modal opacity-0 pointer-events-none  fixed w-full h-full top-0 left-0 flex items-center justify-center">
       <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
       <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
           <br>
           <h3 class="flex justify-center text-lg leading-6 font-medium text-gray-900" id="modal-headline">
           </h3>
           <br><br>
           <form id="form-request" method="POST" class="modal-content py-4 text-left px-6">
               @csrf
               <div class="flex justify-center pt-2justify">
                   <input class='hidden' name="relStatus">
                   <input type="submit" name="confirm" id="accept-confirm"
                       class="px-4 bg-green-400 p-3 focus:outline-none rounded-lg text-white-500 hover:bg-gray-100 hover:text-indigo-400 mr-2"
                       value="accept">
                   <input type='submit' value='decline' name="decline" id="accept-close"
                       class="px-4 bg-transparent p-3 focus:outline-none  rounded-lg text-indigo-500 hover:bg-gray-100 hover:text-indigo-400 mr-2">
               </div>
           </form>
       </div>
   </div>
