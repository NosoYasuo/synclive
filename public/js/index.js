function GetInfoWatch(id) {
    var videoId = document.getElementById('watchId'+id).textContent;
    var videoUrl = 'https://www.youtube.com/watch?v=' + videoId;
    var oembedUrl = 'https://noembed.com/embed?url=' + videoUrl;
    jQuery.ajax({
        url: oembedUrl,
        type: 'GET',
        dataType: 'json',
        success: function(resp) {
          document.getElementById("author"+id).innerHTML = resp.author_name;
          document.getElementById("title"+id).innerHTML = resp.title;
          // console.log(resp.title);
          // console.log(resp.author_name);
        },
        error: function(data) {
          console.error('error occured');
        }
    });
}

function GetInfoChannel(id) {
    var videoId = document.getElementById('c_watchId'+id).textContent;
    var videoUrl = 'https://www.youtube.com/watch?v=' + videoId;
    var oembedUrl = 'https://noembed.com/embed?url=' + videoUrl;
    jQuery.ajax({
        url: oembedUrl,
        type: 'GET',
        dataType: 'json',
        success: function(resp) {
          document.getElementById("c_author"+id).innerHTML = resp.author_name;
          document.getElementById("c_title"+id).innerHTML = resp.title;
          // console.log(resp.title);
          // console.log(resp.author_name);
        },
        error: function(data) {
          console.error('error occured');
        }
    });
}
