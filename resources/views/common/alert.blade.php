{{-- Message --}}
@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <i class="fa fa-times"></i>
        </button>
        <p style=" color: green; text-align: center"><strong style="padding: 5px 10px; border-radius: 5px; border: 2px solid green; font-family: 'Trebuchet MS'; background: lightgreen;">{{ session('success') }}</strong></p>
    </div>
@endif

<script>
    window.onload = () => {
        setTimeout(() => {document.querySelector('.alert').style = 'transition: 1s ease-in-out; transform: translateY(-100px)'}, 2000);
        setTimeout(() => {document.querySelector('.alert').classList.toggle('hidden')}, 3000);
    }
</script>
