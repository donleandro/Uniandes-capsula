/**
 * In this file we will be using Reactjs for build our application example
 * so, below we have our clasic welcome code - Hello World -
 */

require('./bootstrap');

import React, { useState } from 'react';
import ReactDOM from 'react-dom';

import Camera, {
    FACING_MODES,
    IMAGE_TYPES
} from 'react-html5-camera-photo';
import 'react-html5-camera-photo/build/css/index.css';

import ImagePreview from './ImagePreview';

import axios from 'axios';

function App(props) {
    const [dataUri, setDataUri] = useState('');
    const isFullscreen = false;

    function fileUpload(image) {
        axios.post('/insert', {
                imagen: image
            })
            .then(function(response) {
                console.log(response.data);
            })
            .catch(function(error) {
                console.log(error.response);
            });
    }


    function handleTakePhoto(dataUri) {
        // Do stuff with the photo...
        console.log('takePhoto');
        fileUpload(dataUri);
    }

    function handleTakePhotoAnimationDone(dataUri) {
        console.log('takePhoto');
        setDataUri(dataUri);
    }
    return ( <
        div > {
            (dataUri) ?
            < ImagePreview dataUri = {
                dataUri
            }
            isFullscreen = {
                isFullscreen
            }
            /> :
                < Camera onTakePhotoAnimationDone = {
                handleTakePhotoAnimationDone
            }
            isFullscreen = {
                isFullscreen
            }
            imageType = {
                IMAGE_TYPES.JPG
            }
            isMaxResolution = {
                true
            }
            />
        } <
        /div>
    );
}

export default App;


ReactDOM.render( <
    App / > ,
    document.getElementById('app')
);
