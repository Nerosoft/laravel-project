<div id="toastContainer" style="position: fixed; top: 70px; right: 10px; z-index: 9999; max-height: 90vh; overflow-y: auto;"></div>
@if ($errors->any() || session('success') || isset($lang->successfully1))
    <script>
        let arrayOfError = @json($errors->any() ? $errors->all() : (session('success') ? session('success') : $lang->successfully1));
        $(document).ready(function () {
            if(Array.isArray(arrayOfError))
                arrayOfError.forEach((text) => createToast(text, 'danger'));
            else
                createToast(arrayOfError, 'success');
        });
    </script>
@endif
