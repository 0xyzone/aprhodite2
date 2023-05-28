@if (session()->has('error'))
    <div class="hidden lg:block fixed z-20 px-4 py-4 bottom-8 right-8 text-rose-800 bg-rose-300 shadow-lg shadow-rose-500/50 rounded-lg fadeInRight" role="alert" id="error">
        {{ session('error') }}
    </div>
    
    <div class="flex justify-center w-full">
        <div class="lg:hidden fixed z-20 px-4 py-4 bottom-1 text-rose-800 bg-rose-300 shadow-lg shadow-rose-500/50 rounded-lg fadeInBottom" role="alert" id="error2">
            {{ session('error') }}
        </div>
    </div>
    <script>
        setTimeout(function() {
            $('#error').fadeOut('slow');
        }, 3000); // <-- time in milliseconds
        setTimeout(function() {
            $('#error2').fadeOut('slow');
        }, 3000); // <-- time in milliseconds
    </script>
@endif
