<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
        tinymce.init({
            selector: "#edittext_id",
            content_css : "{{ asset('css/tinymce_custom.css') }}",
            theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
            font_size_style_values : "10px,12px,13px,14px,16px,18px,20px",
            autoresize_min_height: 350,
            theme: "modern",
            relative_urls: false,
            plugins: [
                "autoresize image table link insertdatetime preview media print hr jbimages"
            ],
         	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | jbimages | media"
         	});
</script>
<script type="text/javascript">
        tinymce.init({
            selector: "#edittext_en",
            content_css : "{{ asset('css/tinymce_custom.css') }}",
            theme_advanced_font_sizes: "10px,12px,13px,14px,16px,18px,20px",
            font_size_style_values : "10px,12px,13px,14px,16px,18px,20px",
            autoresize_min_height: 350,
            theme: "modern",
            relative_urls: false,
            plugins: [
                "autoresize image table link insertdatetime preview media print hr jbimages"
            ],
         	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | jbimages | media"
         	});
</script>
