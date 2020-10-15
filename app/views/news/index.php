<?php
use vendor\helpers\HTML;
?>

<div class="page-header">
    <h1>News - Index</h1>
</div>
<div id="ajaxResponse"></div>
<div class="list-group">

    <button class="btn-success btn" id="btn">Ajax</button>
    
    <br /><br />
    
<?php foreach ($news as $item) { ?>

    <a href="<?= HTML::a('news', $item->id) ?>" class="list-group-item">
        <h4 class="list-group-item-heading"><?= $item->title ?></h4>
        <p class="list-group-item-text"><?= $item->lid ?></p>
    </a>

<?php } ?></div>

<script>
    $('#btn').click(function(){
        //alert('123');
        $.ajax({
            url: 'http://fw.ru/news/solo-ajax',
            type: 'post',
            data: {'id':12},
            success:function(response){
                $('#ajaxResponse').html(response);
            },
            error:function(){
                
            }
        })
    })
</script>