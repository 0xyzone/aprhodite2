@if (session()->has('success'))
    <div class="hidden lg:block fixed z-20 px-4 py-4 bottom-8 right-8 text-lime-800 bg-lime-300 shadow-lg shadow-lime-600/50 rounded-lg fadeInRight" role="alert" id="success">
        {{ session('success') }}
    </div>
    
    <div class="flex justify-center w-full">
        <div class="lg:hidden fixed z-20 px-4 py-4 bottom-1 text-lime-800 bg-lime-300 shadow-lg shadow-lime-600/50 rounded-lg fadeInBottom" role="alert" id="success2">
            {{ session('success') }}
        </div>
    </div>
    <script>
        setTimeout(function() {
            $('#success').fadeOut('slow');
        }, 3000); // <-- time in milliseconds
        setTimeout(function() {
            $('#success2').fadeOut('slow');
        }, 3000); // <-- time in milliseconds
    </script>
@endif
