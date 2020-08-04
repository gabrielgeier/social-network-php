setTimeout(fade_out, 5000);

function fade_out() {
  $("#fade").fadeOut().empty();
}

setInterval(refresh_logs(), 2000);

function refresh_logs() {
  $("#comments").refresh_logs().empty();
}