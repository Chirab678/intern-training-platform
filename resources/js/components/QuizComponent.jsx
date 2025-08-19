import React from 'react';

const QuizComponent = ({ quiz, onSubmit }) => (
    <form onSubmit={onSubmit} className="quiz-component">
        <h3>{quiz?.title}</h3>
        {quiz?.questions?.map((q, idx) => (
            <div key={q.id} className="mb-4">
                <label>{idx + 1}. {q.text}</label>
                <input type="text" name={`answers[${q.id}]`} className="form-input mt-1 block w-full" />
            </div>
        ))}
        <button type="submit" className="btn btn-primary">Soumettre</button>
    </form>
);

export default QuizComponent;
