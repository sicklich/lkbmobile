<!--css-->
<style type="text/css">
    #header {
        padding: 10px;
        background-color: #e2f5e3;
    }

    #search {
        margin-top: 5px;
        padding-left: 0;
        padding-right: 0;
    }

    #logo {
        padding-left: 20%;
        width: 108px;
        height: 22px;
    }

    p {
        font-size: 1em;
        color: #000000;
    }
</style>

<div id="header" class="row">
    <div class="col-xs-2">
        <a href="/home">
        <img id="back" src="/images/fangzi.png" alt="back" />
        </a>
    </div>
    <div class="col-xs-5 col-xs-offset-1">
        <a href="/home">
            <img id="logo" src="/images/logo-2.png" alt="logo" />
        </a>
    </div>
</div>

<div class="row" style="padding: 0 15px">
    <div id="search" class="col-xs-12">
        <div class="input-group">
            <input id="searchText" type="text" class="form-control" placeholder="请输入关键词" value="<?php echo $data['keywords']?>">
            <span class="input-group-btn">
                <button id="searchButton" class="btn btn-success" type="button">搜索</button>
            </span>
        </div>
    </div>
</div>

<?php

    // 当为首页时候上一页按钮失效, 当为最后一页时, 下一页按钮失效, true为失效
    $disable = array(
        'last' => false,
        'next' => false
    );
    $number = count($data['articleList']); // 搜索结果的数量

    if ($data['page'] == 1)
        $disable['last'] = true;

    if ($number < 10)
        $disable['next'] = true;

    if ($number == 0)
        echo "<div class='row' style='margin-top: 40px; margin-bottom: 40px'>
                <div class='col-xs-2'></div>
                <div class='col-xs-8'>
                    <p style='font-size: 2em'>
                        对不起, 找不到相关的信息了。您可以尝试输入别的关键字或者返回首页
                    </p>
                </div>
              </div>";

    foreach ($data['articleList'] as $article) {
        $description = $article->description;
        //$description = substr($description, 0, 180);
        echo "<div class='row' style='border-bottom: 1px solid #e2f5e3; margin:0 1px'>
                <div class='col-xs-5' style='margin: 10px 0; padding: 0'>
                    <a href='/article?id=$article->id'>
                        <img src='$article->litpic!120x80' width='100%' height='100%' />
                    </a>
                </div>
                <div class='col-xs-7' style='padding-right: 0'>
                    <div class='row'>
                        <div class='col-xs-12'>
                            <a href='/article?id=$article->id'>
                                <h5>
                                    $article->title
                                </h5>
                            </a>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-xs-12'>
                            <a href='/article?id=$article->id' style='text-decoration: none'>
                                <p>$description</p>
                            </a>
                        </div>
                    </div>
                </div>
              </div>";
    }
?>

<div class="row" style="margin: 5px 0">
    <div class="col-xs-6" style="padding-left: 0">
        <?php
            $button = "<button id='lastPage' class='btn btn-success btn-block' type='button'>上一页</button>";
            if ($disable['last'])
                $button = "<button id='lastPage' class='btn btn-block' type='button' disabled='disabled'>上一页</button>";
            echo $button;
        ?>
    </div>
    <div class="col-xs-6" style="padding-right: 0">
        <?php
            $button = "<button id='nextPage' class='btn btn-success btn-block' type='button'>下一页</button>";
            if ($disable['next'])
                $button = "<button id='nextPage' class='btn btn-block' type='button' disabled='disabled'>下一页</button>";
            echo $button;
        ?>
    </div>
</div>

<script>
    window.onload = function() {
        var page = <?php echo $data['page']; ?>

        $("#searchButton").click(function() {
            var keywords = $("#searchText").val();
            location.href = "/search?keywords=" + keywords;
        });

        $("#lastPage").click(function() {
            var keywords = $("#searchText").val();
            location.href = "/search?keywords=" + keywords + "&page=" + (page - 1);
        });

        $("#nextPage").click(function() {
            var keywords = $("#searchText").val();
            location.href = "/search?keywords=" + keywords + "&page=" + (page + 1);
        });
    }
</script>