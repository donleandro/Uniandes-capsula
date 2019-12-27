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

class App extends React.Component {
  constructor(props) {
    super(props);

    this.handleCorreoClick = this.handleCorreoClick.bind(this);
    this.handleNombreClick = this.handleNombreClick.bind(this);
    this.handleApellidoClick = this.handleApellidoClick.bind(this);

    this.updateCorreoClick = this.updateCorreoClick.bind(this);
    this.updateNombreClick = this.updateNombreClick.bind(this);
    this.updateApellidoClick = this.updateApellidoClick.bind(this);

    this.handleTakePhoto = this.handleTakePhoto.bind(this);

    this.state = {isLoggedIn: 0,
                  correo:"",
                  nombre:"",
                  apellido:"",
                  image:""
                  };
  }
  handleCorreoClick() {
    this.setState({isLoggedIn: 1});
    console.log(this.state);
  }
  handleNombreClick() {
    this.setState({isLoggedIn: 2});
  }
  handleApellidoClick() {
    console.log(this.state);
    this.setState({isLoggedIn: 3});
  }
  updateCorreoClick(evt) {
    this.setState({correo: evt.target.value});
  }
  updateNombreClick(evt) {
    this.setState({nombre: evt.target.value});
  }
  updateApellidoClick(evt) {
    this.setState({apellido: evt.target.value});
  }
  handleTakePhoto (dataUri) {
    // Do stuff with the photo...
    console.log('takePhoto');
    this.setState({image: dataUri});
    console.log(this.state);
    this.fileUpload(dataUri);
  }
  fileUpload(dataUri) {
      axios.post('/insert', {
              imagen: dataUri,
              nombre: this.state.nombre,
              apellido: this.state.apellido,
              correo: this.state.correo
          })
          .then(function(response) {
              console.log(response.data);
          })
          .catch(function(error) {
              console.log(error.response);
          });
  }
  render() {
    const isLoggedIn = this.state.isLoggedIn;
    const image = this.state.image;
    let button;
    if (isLoggedIn==0) {
      return <Correo onClick={this.handleCorreoClick} onChange={this.updateCorreoClick} />;
    }
    if (isLoggedIn==1) {
      return <Nombre onClick={this.handleNombreClick} onChange={this.updateNombreClick} />;
    }
    if (isLoggedIn==2) {
      return <Apellido onClick={this.handleApellidoClick} onChange={this.updateApellidoClick} />;
    }
    if(!image){
      return <Camera
        onTakePhoto = { (dataUri) => { this.handleTakePhoto(dataUri); } }
      />;
    }
    return < ImagePreview dataUri = {this.state.image}/>
  }
}

function Camara(props) {
    const [dataUri, setDataUri] = useState('');
    const [correo, setCorreo] = useState('');
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
    return ( <div > {
            (dataUri) ?< ImagePreview dataUri = {dataUri}/> :< Camera onTakePhotoAnimationDone = { handleTakePhotoAnimationDone}/>
        } </div>
    );
}


function Correo(props) {
  return (
    <main>
			<div class="content">
				<div class="frame">
					<div class="frame__demos">
						<div class="frame__demo">La cápsula del tiempo es una aplicación para enviar un mensaje a tu yo del futuro. Este mensaje te llegará en dos años.</div>
					</div>
				</div>
        <div class="content__title-wrap-input">
          <span class="content__pretitle">Ingresa tu correo institucional sin @uniandes</span>
          <input onChange={props.onChange} type="email" placeholder="Email" class="content__input" id="exampleInputPassword1" />
          </div>
        <button onClick={props.onClick}>Ingresar</button>
			</div>
		</main>
  );
}

function Nombre(props) {
  return (
    <main>
			<div class="content">
				<div class="frame">
					<div class="frame__demos">
						<div class="frame__demo">La cápsula del tiempo es una aplicación para enviar un mensaje a tu yo del futuro. Este mensaje te llegará en dos años.</div>
					</div>
				</div>
        <div class="content__title-wrap-input">
          <span class="content__pretitle">Ingresa tu nombre</span>
          <input onChange={props.onChange} type="text" placeholder="Nombre" class="content__input" />
          </div>
        <button onClick={props.onClick} >Ingresar</button>
			</div>
		</main>
  );
}
function Apellido(props) {
  return (
    <main>
			<div class="content">
				<div class="frame">
					<div class="frame__demos">
						<div class="frame__demo">La cápsula del tiempo es una aplicación para enviar un mensaje a tu yo del futuro. Este mensaje te llegará en dos años.</div>
					</div>
				</div>
        <div class="content__title-wrap-input">
          <input onChange={props.onChange} type="text" placeholder="Apellido" class="content__input" />
          </div>
        <button onClick={props.onClick} >Ingresar</button>
			</div>
		</main>
  );
}


export default App;


ReactDOM.render( < App  isLoggedIn={0} / > ,
    document.getElementById('app')
);
