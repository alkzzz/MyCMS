<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
        tinymce.init({
            selector: "#edittext",
            autoresize_min_height: 350,
            theme: "modern",
            relative_urls: false,
            plugins: [
                "autoresize image table link insertdatetime preview media print hr jbimages"
            ],
         	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | jbimages | media"
         	});
</script>
f
