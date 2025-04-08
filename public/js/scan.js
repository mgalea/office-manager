/*
 *  Copyright (c) 2015 The WebRTC project authors. All Rights Reserved.
 *
 *  Use of this source code is governed by a BSD-style license
 *  that can be found in the LICENSE file in the root of the source
 *  tree.
 */

const video = (window.video = document.querySelector("video"));
const videoSelect = document.querySelector("select#videoSource");
const snapShot = document.querySelector("#snapshot");
const webCam = document.querySelector("#webcam");
const canvas = (window.canvas = document.querySelector("canvas"));

const selectors = [videoSelect];

var quickScan = [
  {
    label: "4K(UHD)",
    width: 3840,
    height: 2160,
    ratio: "16:9",
    result: false,
  },
  {
    label: "1080p(FHD)",
    width: 1920,
    height: 1080,
    ratio: "16:9",
    result: false,
  },
  {
    label: "UXGA",
    width: 1600,
    height: 1200,
    ratio: "4:3",
    result: false,
  },
  {
    label: "720p(HD)",
    width: 1280,
    height: 720,
    ratio: "16:9",
    result: false,
  },
  {
    label: "SVGA",
    width: 800,
    height: 600,
    ratio: "4:3",
    result: false,
  },
  {
    label: "VGA",
    width: 640,
    height: 480,
    ratio: "4:3",
    result: false,
  },
  {
    label: "360p(nHD)",
    width: 640,
    height: 360,
    ratio: "16:9",
    result: false,
  },
  {
    label: "CIF",
    width: 352,
    height: 288,
    ratio: "4:3",
    result: false,
  },
  {
    label: "QVGA",
    width: 320,
    height: 240,
    ratio: "4:3",
    result: false,
  },
  {
    label: "QCIF",
    width: 176,
    height: 144,
    ratio: "4:3",
    result: false,
  },
  {
    label: "QQVGA",
    width: 160,
    height: 120,
    ratio: "4:3",
    result: false,
  },
];

function drawVideoCanvas() {
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  const ctx = canvas.getContext("2d");
  ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
}

const buttonClose = document.querySelector("#btnClose");

buttonClose.onclick = function (e) {
  e.preventDefault();
  snapShot.style.display = "none";
  webCam.style.display = "flex";
};

function gotDevices(deviceInfos) {
  // Handles being called several times to update labels. Preserve values.
  const values = selectors.map((select) => select.value);
  selectors.forEach((select) => {
    while (select.firstChild) {
      select.removeChild(select.firstChild);
    }
  });
  for (let i = 0; i !== deviceInfos.length; ++i) {
    const deviceInfo = deviceInfos[i];
    const option = document.createElement("option");
    option.value = deviceInfo.deviceId;
    if (deviceInfo.kind === "videoinput") {
      option.text = deviceInfo.label || `camera ${videoSelect.length + 1}`;
      videoSelect.appendChild(option);
    }
  }

  selectors.forEach((select, selectorIndex) => {
    if (
      Array.prototype.slice
        .call(select.childNodes)
        .some((n) => n.value === values[selectorIndex])
    ) {
      select.value = values[selectorIndex];
    }
  });
}

navigator.mediaDevices.enumerateDevices().then(gotDevices).catch(handleError);

function gotStream(stream) {
  window.stream = stream; // make stream available to console
  video.srcObject = stream;

  return navigator.mediaDevices.enumerateDevices();
}

function handleError(error) {
  if (typeof error == "undefined") {
    console.log("OK");
    return true;
  }
  console.log("getUserMedia error: ", error.message, error.name);
}

function start() {
  if (window.stream) {
    window.stream.getTracks().forEach((track) => {
      track.stop();
    });
  }
  var count = 1;

    console.log("trying " + quickScan[count].label);
    const videoSource = videoSelect.value;
    let constraints = {
      audio: false,
      video: {
        width: { exact: quickScan[count].width },
        height: { exact: quickScan[count].height },
        deviceId: videoSource ? { exact: videoSource } : undefined,
      },
    };

    navigator.mediaDevices
      .getUserMedia(constraints)
      .then(gotStream)
      .then(gotDevices)
      .then((count) => count, handleError);
  }


videoSelect.onchange = start;

$(document).ready(() => {
  start();
});
