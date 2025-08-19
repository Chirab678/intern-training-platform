import React from 'react';

const ProgressBar = ({ value = 0 }) => (
    <div className="w-full bg-gray-200 rounded-full h-4">
        <div className="bg-primary-600 h-4 rounded-full" style={{ width: `${value}%` }}></div>
    </div>
);

export default ProgressBar;
