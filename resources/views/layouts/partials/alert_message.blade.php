{{-- Toastr success Notification --}}
@if (session()->has('success'))
<script type="text/javascript">
    $(function () {
        toastr.success("","{{session()->get("success")}}");
    });
</script>
@endif
{{-- Toastr message Notification --}}
@if (session()->has('message'))
<script type="text/javascript">
    $(function () {
        toastr.message("","{{session()->get("message")}}");
    });
</script>
@endif

{{-- Toastr info Notification --}}
@if (session()->has('info'))
<script type="text/javascript">
    $(function () {
     toastr.info("","{{session()->get("info")}}");
 });
</script>
@endif
{{-- Toastr warning Notification --}}
@if (session()->has('warning'))
<script type="text/javascript">
    $(function () {
     toastr.warning("","{{session()->get("warning")}}");
 });
</script>
@endif  
{{-- Toastr error Notification --}}
@if (session()->has('error'))
<script type="text/javascript">
    $(function () {
     toastr.error("","{{session()->get("error")}}");
 });
</script>
@endif