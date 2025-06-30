import React from 'react';
import './styles.css';

const Registration = () => {
  return (
    <div className="container d-flex justify-content-center align-items-center vh-100">
      <div className="card p-4 shadow-lg" style={{ width: '350px' }}>
        <h2 className="text-center">Регистрация</h2>
        <form>
          <div className="mb-3">
            <input type="text" className="form-control" placeholder="Имя пользователя" required />
          </div>
          <div className="mb-3">
            <input type="email" className="form-control" placeholder="Почта" required />
          </div>
          <div className="mb-3">
            <input type="password" className="form-control" placeholder="Пароль" required />
          </div>
          <button type="submit" className="btn btn-success w-100">Зарегистрироваться</button>
        </form>
      </div>
    </div>
  );
};

export default Registration;
