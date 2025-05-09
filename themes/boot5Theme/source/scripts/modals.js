'use strict';

const videoModalElem = document.getElementById('videoModal');
const videoModal = new bootstrap.Modal(videoModalElem);
videoModalElem.addEventListener('hidden.bs.modal', event => {

    let modalVideoiFrame = videoModalElem.querySelector('iframe');
    let modalVideoTitle= videoModalElem.querySelector('#videoModalLabel');
    modalVideoiFrame.src = '';
    modalVideoTitle.innerHTML = '';

})


function playVideoModal(){

    var videoTrigger = $("body").find('[data-bs-target="#videoModal"]');
    const videoModal = new bootstrap.Modal('#videoModal');

    videoTrigger.click(async event => {

        event.preventDefault(); 

        var videosrc = event.currentTarget.dataset.videosrc;
        var videotitle = event.currentTarget.dataset.videotitle;

        await populateVideoModal(videosrc, videotitle);

        videoModal.show();
  
  });
}


var populateVideoModal = async(videosrc, videotitle) => {

    let modalVideoiFrame = videoModalElem.querySelector('iframe');
    let modalVideoTitle = videoModalElem.querySelector('#videoModalLabel');

    modalVideoiFrame.src = videosrc;
    modalVideoTitle.innerHTML = videotitle;

    return true;
}


$(document).ready(function() { 
    playVideoModal();
});

const searchModalElem = document.getElementById('modalSearch');
const searchModal = new bootstrap.Modal(searchModalElem);
const searchModalInput = searchModalElem.querySelector('.search-field');
searchModalElem.addEventListener('shown.bs.modal', event => {

    searchModalInput.focus()
    searchModalInput.select();
    
})