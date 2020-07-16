import React from 'react';
import PropTypes from 'prop-types';

import './style.css';

export const ImagePreview = ({ dataUri }) => {
  var divStyle = {
    backgroundImage: 'url(' + dataUri.image + ')',
    backgroundPosition: 'center',
    backgroundSize: 'cover',
    backgroundRepeat: 'no-repeat'
  };
  return (
    <main>
			<div class="content" style={divStyle}>
				<div class="frame">
					<div class="frame__demos">

					</div>
				</div>
        <div class="content__title-wrap-input">
          <span className="content__pretitle">Para: {dataUri.correo}@uniandes.edu.co</span>
          <span className="content__input">{dataUri.mensaje}</span>
          </div>
        <button>ENVIAR</button>
			</div>
		</main>
  );
};

ImagePreview.propTypes = {
  dataUri: PropTypes.object
};

export default ImagePreview;
