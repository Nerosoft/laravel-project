<div id="toastContainer" style="position: fixed; top: 70px; right: 10px; z-index: 9999; max-height: 90vh; overflow-y: auto;"></div>
@if ($errors->any())
    <script>
        $(document).ready(function () {
            @json($errors->all()).forEach((text) => createToast(text, 'danger'));
        });
    </script>
@elseif(session('success'))
    <script>
        $(document).ready(function () {
            createToast(@json(session('success')), 'success');
        });
    </script>
@elseif(isset($lang->successfully1))
    <script>
        $(document).ready(function () {
            createToast(@json($lang->successfully1), 'success');
        });
    </script>
@endif
