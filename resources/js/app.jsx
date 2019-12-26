/**
 * In this file we will be using Reactjs for build our application example
 * so, below we have our clasic welcome code - Hello World -
 */

require('./bootstrap');

import React from 'react';
import ReactDOM from 'react-dom';
import Camera, {
    FACING_MODES,
    IMAGE_TYPES
} from 'react-html5-camera-photo';
import 'react-html5-camera-photo/build/css/index.css';
import axios from 'axios';

function App(props) {

    function fileUpload(image) {
        // const url = 'https://capsula.test/insert';
        // console.log('takePhoto');
        // const formData = {
        //     file: image
        // }
        // return post(url, formData)
        //     .then(response => console.log(response))

        axios.post('/insert', {
            imagen: image
        })
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            console.log(error.response);
        });

    }


function handleTakePhoto(dataUri) {
    // Do stuff with the photo...
    console.log('takePhoto');
    fileUpload(dataUri);
}

function handleTakePhotoAnimationDone(dataUri) {
    // Do stuff with the photo...
    console.log('takePhoto');
}

function handleCameraError(error) {
    console.log('handleCameraError', error);
}

function handleCameraStart(stream) {
    console.log('handleCameraStart');
}

function handleCameraStop() {
    console.log('handleCameraStop');
}

return ( <
    Camera onTakePhoto = {
        (dataUri) => {
            handleTakePhoto(dataUri);
        }
    }
    onTakePhotoAnimationDone = {
        (dataUri) => {
            handleTakePhotoAnimationDone(dataUri);
        }
    }
    onCameraError = {
        (error) => {
            handleCameraError(error);
        }
    }
    idealFacingMode = {
        FACING_MODES.ENVIRONMENT
    }
    idealResolution = {
        {
            width: 640,
            height: 480
        }
    }
    imageType = {
        IMAGE_TYPES.JPG
    }
    imageCompression = {
        0.97
    }
    isMaxResolution = {
        true
    }
    isImageMirror = {
        false
    }
    isSilentMode = {
        false
    }
    isDisplayStartCameraError = {
        true
    }
    isFullscreen = {
        false
    }
    sizeFactor = {
        1
    }
    onCameraStart = {
        (stream) => {
            handleCameraStart(stream);
        }
    }
    onCameraStop = {
        () => {
            handleCameraStop();
        }
    }
    />
);
}

export default App;


ReactDOM.render( <
    App / > ,
    document.getElementById('app')
);
