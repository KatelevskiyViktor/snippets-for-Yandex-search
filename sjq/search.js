function thumbnailPDF(){
    $('.b-serp-item__content').each(function(index, element){
        let item = $(this);
        let href = item.find('.b-serp-item__title-link').attr('href');
        let hrefSplited = href.split('/');
        let fileName = hrefSplited[hrefSplited.length-1];
        let linkFile = '/' + hrefSplited[hrefSplited.length-2] + '/' + fileName;
        if(fileName.substr(fileName.length - 3).toLowerCase() !== 'pdf'){
            findFirstIMGAndResponce(linkFile, item)
        } else {
            getAndSetThumbnails(fileName, hrefSplited, item);
            // item.prepend('<img class="pdfIMG" data-pdf-thumbnail-file="' + linkFile + '" data-pdf-thumbnail-width="50" data-pdf-thumbnail-height="81" >'); // part to jquery thumbnails
        }

    });
    // $('head').append('<script src="pdfThumbnails.js" data-pdfjs-src="pdf.js"><\/script>');
    timerToScrollPage();// part to jquery thumbnails
}

function getAndSetThumbnails(fileName, hrefSplited, item){
    item.prepend('<img src="'+ hrefSplited[0] + '//' + hrefSplited[2] + '/' + hrefSplited[3] + '/' + 'thumbnail' + '/' +  fileName.substr(0 , (fileName.length - 3)) + 'jpg' +'" class="pdfIMG" width="40" height="71" >');

}

function findFirstIMGAndResponce(href, item){
    $.get( href, function( data ) {
        item.prepend('<img src="'+ $(data).find('img').eq(0).attr('src') +'" class="pdfIMG" width="40" height="71" >');
    });
}

function timerToScrollPage(){
    $('.b-pager__page').on('click', function (){
        setTimeout(thumbnailPDF,1000);
    });
}// part to jquery thumbnails



$(window).on("load", function () {
    thumbnailPDF();

});
