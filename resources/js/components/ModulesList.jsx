import React from 'react';

const ModulesList = ({ modules }) => (
    <ul className="modules-list">
        {modules && modules.length ? (
            modules.map(module => (
                <li key={module.id}>{module.title} (Mois {module.month})</li>
            ))
        ) : (
            <li>Aucun module disponible.</li>
        )}
    </ul>
);

export default ModulesList;
