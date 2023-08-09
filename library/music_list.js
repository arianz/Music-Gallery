const banner_img = document.querySelector('#player-img-holder>img');
const disc = document.getElementById('player-el');
const title = document.getElementById('title');
const artist = document.getElementById('artist');
const progressContainer = document.getElementById('progress-container');
const progress = document.getElementById('progress');
const timer = document.getElementById('timer');
const duration = document.getElementById('duration');
const play = document.getElementById('play');
const volumeDownButton = document.getElementById('volume-down');
const volumeUpButton = document.getElementById('volume-up');
let volume = 0.5;
disc.volume = volume;

$(function () {
  $('#search_cat').on('input change', function (e) {
    e.preventDefault();
    const _search = $(this).val().toLowerCase();
    $('.cat-items').each(function (e) {
      const _text = $(this).text().toLowerCase();
      if (_text.includes(_search) === true) {
        $(this).toggle(true);
      } else {
        $(this).toggle(false);
      }
    });
  });

  $('.view_music_details').click(function (e) {
    e.preventDefault();
    const id = $(this).attr('data-id');
    uni_modal(
      'Music Details',
      'http://localhost/php-music/view_music_details.php?id=' + id,
      'modal-large'
    );
  });

  $('.play_music').click(function (e) {
    e.preventDefault();
    const audioUrl = $(this).data('audio');
    const isPlaying = $(this).hasClass('playing');
    if (isPlaying) {
      stopAudio();
    } else {
      playAudio(audioUrl);
      $('.play_music').removeClass('playing');
      $(this).addClass('playing');
    }
  });

    // Volume down button event listener
  volumeDownButton.addEventListener('click', function() {
    adjustVolume(-0.1);
  });

  // Volume up button event listener
  volumeUpButton.addEventListener('click', function() {
    adjustVolume(0.1);
  });

  function adjustVolume(change) {
    let volume = disc.volume + change;
    volume = Math.max(0, Math.min(2, volume)); // Ensure volume is between 0 and 2
    disc.volume = volume;
  }

  // Play button event listener
  play.addEventListener('click', function() {
    togglePlay();
  });

  const audioPlayer = document.getElementById('player-el');

  function playAudio(audioUrl) {
    audioPlayer.src = audioUrl;
    audioPlayer.play();
    $('#player-field').css('display', 'flex');
    updatePlayPauseIcon(true);
    updateMetadata(audioUrl);
    updateProgressBar();
  }

  function stopAudio() {
    audioPlayer.pause();
    audioPlayer.currentTime = 0;
    $('#player-field').css('display', 'none');
    updatePlayPauseIcon(false);
  }

  function updatePlayPauseIcon(isPlaying) {
    const icon = play.querySelector('i');
    if (isPlaying) {
      icon.classList.remove('fa-play');
      icon.classList.add('fa-pause');
    } else {
      icon.classList.remove('fa-pause');
      icon.classList.add('fa-play');
    }
  }

  function updateMetadata(audioUrl) {
    const songs = getSongs();
    const song = songs.find((song) => song.audio_path === audioUrl);
    if (song) {
      banner_img.src = song.banner_path;
      title.textContent = song.title;
      artist.textContent = song.artist;
    }
  }

  function updateProgressBar() {
    audioPlayer.addEventListener('timeupdate', function () {
      const { currentTime, duration: totalDuration } = audioPlayer;
      const progressPercent = (currentTime / totalDuration) * 100;
      progress.style.width = progressPercent + '%';
      timer.textContent = formatTime(currentTime);
      duration.textContent = formatTime(totalDuration);
    });
  }

  function formatTime(time) {
    const minutes = Math.floor(time / 60);
    let seconds = Math.floor(time % 60);
    seconds = seconds < 10 ? '0' + seconds : seconds;
    return minutes + ':' + seconds;
  }

  function getSongs() {
    return JSON.parse('<?php echo json_encode($songs); ?>');
  }

  progressContainer.addEventListener('click', function (event) {
    const progressContainerWidth = progressContainer.clientWidth;
    const clickPosition = event.offsetX;
    const seekTime = (clickPosition / progressContainerWidth) * audioPlayer.duration;
    audioPlayer.currentTime = seekTime;
  });

  function togglePlay() {
    if (audioPlayer.paused) {
      audioPlayer.play();
      updatePlayPauseIcon(true);
    } else {
      audioPlayer.pause();
      updatePlayPauseIcon(false);
    }
  }

  // Update the progress bar and timer
  updateProgressBar();
});
