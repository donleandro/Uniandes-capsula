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
    this.handleMensajeClick = this.handleMensajeClick.bind(this);
    this.handleEstadoClick = this.handleEstadoClick.bind(this);

    this.updateEstadoClick = this.updateEstadoClick.bind(this);
    this.updateMensajeClick = this.updateMensajeClick.bind(this);
    this.updateCorreoClick = this.updateCorreoClick.bind(this);
    this.updateNombreClick = this.updateNombreClick.bind(this);
    this.updateApellidoClick = this.updateApellidoClick.bind(this);

    this.handleTakePhoto = this.handleTakePhoto.bind(this);

    this.state = {isLoggedIn: 0,
                  correo:"",
                  nombre:"",
                  apellido:"",
                  image:"",
                  estado:"",
                  mensaje:""
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
  handleMensajeClick() {
    console.log(this.state);
    this.setState({isLoggedIn: 4});
  }
  handleEstadoClick() {
    console.log(this.state);
    this.setState({isLoggedIn: 5});
  }
  updateEstadoClick(evt) {
    this.setState({estado: evt.target.value});
  }
  updateMensajeClick(evt) {
    this.setState({mensaje: evt.target.value});
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
              mensaje: this.state.mensaje,
              estado: this.state.estado,
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
    if (isLoggedIn==3) {
      return <Mensaje onClick={this.handleMensajeClick} onChange={this.updateMensajeClick} />;
    }
    if (isLoggedIn==4) {
      return <Estado onClick={this.handleEstadoClick} onChange={this.updateEstadoClick} />;
    }
    if(!image){
      return <Camera
        onTakePhoto = { (dataUri) => { this.handleTakePhoto(dataUri); } }
      />;
    }
    return < ImagePreview dataUri = {this.state.image}/>
  }
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
        <button onClick={props.onClick}>Siguiente</button>
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

					</div>
				</div>
        <div class="content__title-wrap-input">
          <input onChange={props.onChange} type="text" placeholder="Nombre" class="content__input" />
          </div>
        <button onClick={props.onClick} >Siguiente</button>
			</div>
		</main>
  );
}
function Estado(props){
  return (
    <main>
			<div class="content">
				<div class="frame">
					<div class="frame__demos">

					</div>
				</div>
        <div class="content__input">
          <span class="content__checkbox">¿Deseas que el mensaje no sea público?</span>
          <input onChange={props.onChange} type="checkbox" name="vehicle1" value="1" />
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

					</div>
				</div>
        <div class="content__title-wrap-input">
          <input onChange={props.onChange} type="text" placeholder="Apellido" class="content__input" />
          </div>
        <button onClick={props.onClick} >Siguiente</button>
			</div>
		</main>
  );
}
function Mensaje(props) {
  return (
    <main>
			<div class="content">
				<div class="frame">
					<div class="frame__demos">

					</div>
				</div>
        <div class="content__title-wrap-input">
        <textarea onChange={props.onChange} class="content__input-caja" rows="4" cols="50">Mensaje</textarea>
          <input type="text" placeholder="Mensaje" />
          </div>
        <button onClick={props.onClick} >Siguiente</button>
			</div>
		</main>
  );
}


export default App;


ReactDOM.render( < App  isLoggedIn={0} / > ,
    document.getElementById('app')
);
