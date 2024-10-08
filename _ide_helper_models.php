<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $deck_id
 * @property string $suit
 * @property string $rank
 * @property string|null $discarded_at
 * @property int|null $character_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Character|null $character
 * @property-read \App\Models\Deck $deck
 * @method static \Database\Factories\CardFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Card newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Card newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Card query()
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereDeckId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereDiscardedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereSuit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Card whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperCard {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $pronouns
 * @property string $vanori
 * @property int $str
 * @property int $dex
 * @property int $wil
 * @property int $hrt
 * @property int $resilience_current
 * @property int $resilience_max
 * @property int $experience
 * @property int $armor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Card> $hand
 * @property-read int|null $hand_count
 * @property-read \App\Models\Inventory|null $inventory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InventoryItem> $inventoryItems
 * @property-read int|null $inventory_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CharacterNote> $notes
 * @property-read int|null $notes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Party> $parties
 * @property-read int|null $parties_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CharacterFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Character newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Character newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Character query()
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereArmor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereDex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereHrt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character wherePronouns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereResilienceCurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereResilienceMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereStr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereVanori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Character whereWil($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperCharacter {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $character_id
 * @property string $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Character $character
 * @method static \Database\Factories\CharacterNoteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterNote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterNote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterNote query()
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterNote whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterNote whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterNote whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterNote whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CharacterNote whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperCharacterNote {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Card> $cards
 * @property-read int|null $cards_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Card> $discardPile
 * @property-read int|null $discard_pile_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Card> $drawPile
 * @property-read int|null $draw_pile_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Card> $handPile
 * @property-read int|null $hand_pile_count
 * @property-read \App\Models\Table|null $table
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\DeckFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Deck newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deck newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Deck query()
 * @method static \Illuminate\Database\Eloquent\Builder|Deck whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deck whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deck whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deck whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deck whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Deck whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperDeck {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $character_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Character $character
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\InventoryItem> $inventoryItems
 * @property-read int|null $inventory_items_count
 * @method static \Database\Factories\InventoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inventory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperInventory {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $inventory_id
 * @property string|null $name
 * @property string|null $note
 * @property int $quantity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Inventory $inventory
 * @property-read \App\Models\Character|null $character
 * @method static \Database\Factories\InventoryItemFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereInventoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|InventoryItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperInventoryItem {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property string $join_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Character> $characters
 * @property-read int|null $characters_count
 * @property-read int $size
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PartyMember> $partyMembers
 * @property-read int|null $party_members_count
 * @property-read \App\Models\Table|null $tableParty
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Table> $tables
 * @property-read int|null $tables_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PartyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Party newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Party newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Party query()
 * @method static \Illuminate\Database\Eloquent\Builder|Party whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Party whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Party whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Party whereJoinCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Party whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Party whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Party whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperParty {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $party_id
 * @property int $character_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Character $character
 * @property-read \App\Models\Party $party
 * @method static \Database\Factories\PartyMemberFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|PartyMember newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartyMember newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PartyMember query()
 * @method static \Illuminate\Database\Eloquent\Builder|PartyMember whereCharacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartyMember whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartyMember whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartyMember wherePartyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PartyMember whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPartyMember {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Deck|null $deck
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Party> $party
 * @property-read int|null $party_count
 * @property-read \App\Models\TableDeck|null $tableDeck
 * @property-read \App\Models\TableParty|null $tableParty
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TableFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Table newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Table newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Table query()
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Table whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTable {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $table_id
 * @property int $deck_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Deck $deck
 * @property-read \App\Models\Table $table
 * @method static \Illuminate\Database\Eloquent\Builder|TableDeck newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TableDeck newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TableDeck query()
 * @method static \Illuminate\Database\Eloquent\Builder|TableDeck whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableDeck whereDeckId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableDeck whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableDeck whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableDeck whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTableDeck {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $table_id
 * @property int $party_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Party $party
 * @property-read \App\Models\Table $table
 * @method static \Illuminate\Database\Eloquent\Builder|TableParty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TableParty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TableParty query()
 * @method static \Illuminate\Database\Eloquent\Builder|TableParty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableParty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableParty wherePartyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableParty whereTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TableParty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperTableParty {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Character> $characters
 * @property-read int|null $characters_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Deck> $decks
 * @property-read int|null $decks_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Party> $parties
 * @property-read int|null $parties_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Table> $tables
 * @property-read int|null $tables_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

