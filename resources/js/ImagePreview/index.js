import React from 'react';
import PropTypes from 'prop-types';

import './style.css';

export const ImagePreview = ({ dataUri }) => {

  return (
    <div className={'demo-image-preview demo-image-preview-fullscreen'}>
      <img src={dataUri} />
    </div>
  );
};

ImagePreview.propTypes = {
  dataUri: PropTypes.string
};

export default ImagePreview;
