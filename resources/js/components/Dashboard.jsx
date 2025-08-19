import React from 'react';

const Dashboard = ({ user, stats }) => (
    <div className="dashboard">
        <h2>Bienvenue, {user?.name} !</h2>
        <p>Progression globale : {stats?.overall ?? 0}%</p>
    </div>
);

export default Dashboard;
