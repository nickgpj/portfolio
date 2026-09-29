using EindopdrachtDD1.Helpers;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using EindopdrachtDD1.Model;
using EindopdrachtDD1.Databases;
using System.Windows.Input;
using System.Security.Cryptography.X509Certificates;

namespace EindopdrachtDD1.ViewModel
{
    public class GamesViewModel : ObservableObject
    {
        #region fields
        private ObservableCollection<Game> _games;
        private Game? _selectedGame;
        private Game _game;
        #endregion

        #region properties
        public ObservableCollection<Game> Games { get; }

        public Game Game
        {
            get { return _game; }
            set { _game = value; OnPropertyChanged(); }
        }
        public Game? SelectedGame
        {
            get { return _selectedGame; }
            set
            {
                _selectedGame = value;
                if (_selectedGame != null)
                {
                    Game = new Game
                    {
                        Name = SelectedGame.Name,
                        Genre = SelectedGame.Genre
                    };
                }
                OnPropertyChanged();
            }
        }
        #endregion

        #region constructors
        public GamesViewModel()
        {
            _game = new Game();
            Games = [];
            using (AppDbContext db = new())
            {
                Games = new(db.Games.ToList());
            };

            AddGameCommand = new RelayCommand(ExecuteAddGame, CanAddGame);
            UpdateGameCommand = new RelayCommand(ExecuteUpdateGame, CanUpdateGame);
            DeleteGameCommand = new RelayCommand(ExecuteDeleteGame, CanDeleteGame);
        }
        #endregion

        #region commands
        public ICommand AddGameCommand { get; private set; }
        public ICommand UpdateGameCommand { get; }
        public ICommand DeleteGameCommand { get; }
        #endregion


        #region methods
        public bool CanAddGame(object? obj)
        {
            if (!string.IsNullOrEmpty(Game.Name) && !string.IsNullOrEmpty(Game.Genre))
            {
                return true;
            }
            return false;
        }

        public bool CanUpdateGame(object? obj)
        {
            if (!string.IsNullOrEmpty(Game.Name) && !string.IsNullOrEmpty(Game.Genre))
            {
                return true;
            }

            return false;
        }

        public bool CanDeleteGame(object? obj)
        {
            return SelectedGame != null;
        }

        public void ExecuteAddGame(object? obj)
        {
            Games.Add(Game);
            using AppDbContext db  = new();
            Game.GameId = 0;
            db.Games.Add(Game);
            db.SaveChanges();
            Game = new();
        }

        public void ExecuteUpdateGame(object? obj)
        {
            if (_selectedGame != null)
            {
                _selectedGame.Name = Game.Name;
                _selectedGame.Genre = Game.Genre;

                using AppDbContext db = new();
                Game? databaseGame = db.Games.FirstOrDefault(x => x.GameId == _selectedGame.GameId);
                if (databaseGame != null)
                {
                    databaseGame.Name = _selectedGame.Name;
                    databaseGame.Genre = _selectedGame.Genre;

                    db.SaveChanges();
                }

                Game.Name = string.Empty;
                Game.Genre = string.Empty;
            }
        }

        public void ExecuteDeleteGame(object? obj)
        {
            if (obj is Game teverwijderen)
            {
                Games.Remove(teverwijderen);

                using AppDbContext db = new();
                Game? databaseGame = db.Games.FirstOrDefault(x => x.GameId == teverwijderen.GameId);
                if (databaseGame != null)
                {
                    db.Games.Remove(databaseGame);
                    db.SaveChanges();
                }
            }
        }
        #endregion
    }
}
