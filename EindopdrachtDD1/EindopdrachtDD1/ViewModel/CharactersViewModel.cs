using EindopdrachtDD1.Helpers;
using EindopdrachtDD1.Databases;
using EindopdrachtDD1.Model;
using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Collections.ObjectModel;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Input;
using Microsoft.EntityFrameworkCore.Metadata.Internal;
using System.Windows;

namespace EindopdrachtDD1.ViewModel
{
    public class CharactersViewModel : ObservableObject
    { 
        #region fields
        private ObservableCollection<Character> _characters;
        private ObservableCollection<Game> _games;
        private Character? _selectedCharacter; 
        private Character _character;
        private Game? _selectedGame;
        #endregion

        #region properties
        public ObservableCollection<Character> Characters { get; }
        public ObservableCollection<Game> Games { get; }

        public Game? SelectedGame
        {
            get { return _selectedGame; }
            set {  _selectedGame = value; OnPropertyChanged(); }
        }

        public Character Character
        {
            get { return _character; }
            set {  _character = value; OnPropertyChanged(); }
        }

        public Character? SelectedCharacter
        {
            get { return _selectedCharacter; }
            set { _selectedCharacter = value;
                if (_selectedCharacter != null)
                {
                    Character = new Character
                    {
                        Name = SelectedCharacter.Name,
                        Game = SelectedCharacter.Game,
                    };
                }
                OnPropertyChanged();
            }
        }
        #endregion

        #region constructors
        public CharactersViewModel()
        {
            _character = new Character();
            Characters = [];
            using (AppDbContext db = new())
            {
                Characters = new ObservableCollection<Character>(db.Characters.ToList());
                Games = new ObservableCollection<Game>(db.Games.ToList());
            };

            AddCharacterCommand = new RelayCommand(ExecuteAddCharacter, CanAddCharacter);
            UpdateCharacterCommand = new RelayCommand(ExecuteUpdateCharacter, CanUpdateCharacter);
            DeleteCharacterCommand = new RelayCommand(ExecuteDeleteCharacter, CanDeleteCharacter);
        }
        #endregion

        #region commands 

        public ICommand AddCharacterCommand { get; private set; }
        public ICommand UpdateCharacterCommand { get; set; }
        public ICommand DeleteCharacterCommand { get; set; }
        #endregion

        #region methods
        public bool CanAddCharacter(object? obj)
        {
            if (!string.IsNullOrEmpty(Character.Name))
            {
                return true;
            }
            return false;
        }

        public bool CanUpdateCharacter(object? obj)
        {
            if (!string.IsNullOrEmpty(Character.Name))
            {
                return true;
            }
            return false;
        }

        public bool CanDeleteCharacter(object? obj)
        {
            return SelectedCharacter != null;
        }

        public void ExecuteAddCharacter(object? obj)
        {
            Characters.Add(Character);
            using AppDbContext dbContext = new();
            Character.Id = 0;
            dbContext.Characters.Add(Character);
            dbContext.SaveChanges();
            Character = new();

        }

        public void ExecuteUpdateCharacter(object? obj)
        {
            if (_selectedCharacter != null)
            {
                _selectedCharacter.Name = Character.Name;
                _selectedCharacter.Game = Character.Game;

                using AppDbContext dbContext = new();
                Character? databaseCharacter = dbContext.Characters.FirstOrDefault(x => x.Id == Character.Id);
                if (databaseCharacter != null)
                {
                    databaseCharacter.Name = Character.Name;
                    databaseCharacter.Game = Character.Game;

                    dbContext.SaveChanges();
                }

                Character.Name = string.Empty;
            }
        }

        public void ExecuteDeleteCharacter(object? obj)
        {
            if (obj is Character teverwijderen)
            {
                Characters.Remove(teverwijderen);

                using AppDbContext dbContext = new();
                Character? databaseCharacter = dbContext.Characters.FirstOrDefault(x => x.Id == teverwijderen.Id);
                if (databaseCharacter != null)
                {
                    dbContext.Characters.Remove(databaseCharacter);
                    dbContext.SaveChanges();
                }
            }
        }
        #endregion
    }
}
