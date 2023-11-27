<script>
    $(document).ready(function() {
      $(document).Toasts('create', {
        class: 'bg-danger',
        title: 'ERROR',
        subtitle: 'Failed to add data',
        body: '{!! session('error') !!}'
      })
    });
</script>