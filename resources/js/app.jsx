/**
 * In this file we will be using Reactjs for build our application example
 * so, below we have our clasic welcome code - Hello World -
 */

require('./bootstrap');

import React from 'react';
import ReactDOM from 'react-dom';
import Camera from 'react-html5-camera-photo';
import 'react-html5-camera-photo/build/css/index.css';

function App (props) {
  function handleTakePhoto (dataUri) {
    // Do stuff with the photo...
    console.log('takePhoto');
  }

  return (
    <Camera
      onTakePhoto = { (dataUri) => { handleTakePhoto(dataUri); } }
    />
  );
}

export default App;


ReactDOM.render(
	<App />,
	document.getElementById('app')
);
